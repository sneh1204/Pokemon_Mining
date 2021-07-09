#!/usr/bin/env python
import aiohttp
import asyncio
import random
from PIL import Image
import imagehash
from io import BytesIO
import json
import sys
import requests
import os 

async def main(url, sess):
    async with sess.get(url) as resp:
        assert resp.status == 200
        data = await resp.read()
    img_obj = Image.open(BytesIO(data)).convert('RGBA')
    mould = Image.new("RGBA", img_obj.size, (255, 255, 255))
    refined = Image.alpha_composite(mould, img_obj)
    dhash = str(imagehash.dhash(refined))
    m = dhash.lower()
    await sess.close()
    return m

url = sys.argv[-1]
try:
    request = requests.get(url)
except Exception as e:
    print('Error')

pokenames = []
dir_path = os.path.dirname(os.path.realpath(__file__))
with open(dir_path + '/pokenames.json', 'r', encoding='utf-8') as f:
    pokenames = json.load(f)
loop = asyncio.get_event_loop()
browsers = [
    "Mozilla/5.0 (Windows NT 10.0; WOW64)",
    "AppleWebKit/537.36 (KHTML, like Gecko)",
    "discord/0.0.301",
    "Chrome/56.0.2924.87",
    "Discord/1.6.15",
    "Safari/537.36"
]
headers = {
    "User-Agent": ' '.join(set(random.sample(browsers, k=random.randint(1, len(browsers)))))
}
sess = aiohttp.ClientSession(loop=loop, headers=headers)
data = loop.run_until_complete(main(url=url, sess=sess))
try:
    msg = pokenames[data]
except:
    msg = "Pokemon not found"
    
print(msg)
