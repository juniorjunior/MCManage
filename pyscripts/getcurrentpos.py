import sys
from nbtlib import nbt
from nbtlib.tag import *
from pprint import pprint

spawnPos = [-320.0,70.0,448.0]
spawnDim = 100

dataFileName = sys.argv[1]

#
# Load the main player data file
nbtfile = nbt.load(dataFileName)

print("%d %d %d %d" % (nbtfile['']['Pos'][0], nbtfile['']['Pos'][1], nbtfile['']['Pos'][2], nbtfile['']['Dimension']))
