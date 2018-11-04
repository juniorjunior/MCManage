import sys
from nbtlib import nbt
from nbtlib.tag import *
from pprint import pprint

spawnPos = [1.0,73.0,587.0]
spawnDim = 100

levelFileName = sys.argv[1]
levelfile = nbt.load(levelFileName)
itemdata = levelfile['']['FML']['ItemData']
wands = []
for row, contents in enumerate(itemdata):
    if ( (contents['K'].find('wizardry') >= 0) and (contents['K'].find('wand') >= 0) ):
        wands.append(contents['V'])

#
# Load the main player data file
dataFileName = sys.argv[2]
nbtfile = nbt.load(dataFileName)

badwandcount = 0
#
# Find any wands that have a spell index of -1 and set them to zero
for slot, contents in enumerate(nbtfile['']['Inventory']):
    if ( (contents['id'] in wands) and ('selectedSpell' in contents['tag']) and (contents['tag']['selectedSpell'] == -1) ):
       nbtfile['']['Inventory'][slot]['tag']['selectedSpell'] = Int(0)
       badwandcount += 1

if ( badwandcount > 0 ):
    print("Bad wand(s) found and fixed!")
else:
    print("No wands found containing broken indexes!")

#
# Write the file back out
nbtfile.save()

