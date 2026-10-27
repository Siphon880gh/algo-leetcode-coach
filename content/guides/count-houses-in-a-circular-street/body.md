You stand at a house on a circular street and get an interactive street object plus an upper bound k on the number of houses. You can check whether the current house’s door is open, open or close it, and move to the next house in either direction. Doors start in an unknown state. Return the number of houses. The method names and exact limits are in the official statement. For instance, on a street of 5 houses with k = 10, the answer is 5 whatever the doors start as. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Mark one house

1. Repeat k times: close the door, move right.
2. Open the current door.
3. Move right, counting steps, until a door is open; return the count.

Constructed checks (simulated in code): 5 houses with mixed doors and k = 10 → 5; 3 open doors with k = 5 → 3; 300 random streets with k at least the size → the size.

Without closing first, the walk can stop at a door that was open from the start: the 5-house example → 1 instead of 5.

Time: O(k)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
