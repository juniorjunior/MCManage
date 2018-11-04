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

#
# Set the spawn location and dimensions
for i, coord in enumerate(spawnPos):
    nbtfile['']['Pos'][i] = Double(spawnPos[i])
nbtfile['']['Dimension'] = Int(spawnDim)

print("Player successfully moved to spawn.")

#
# Write the file back out
nbtfile.save()

