## Example first

source = [1, 2, 3], target = [0, 2, 4].

1. Pick i = 0, j = 2, delta = 4.
2. source[0] = 1 + 3 − 4 = 0 and source[2] = 4.
3. source is now [0, 2, 4]. Both sums are 6.

## Why the sum decides it

1. The operation sets source[j] = delta and adds source[j] − delta to source[i], so source[i] + source[j] does not change. The whole sum never changes.
2. Equal sums are also enough. Use the last index as the partner and set positions 0 … n − 2 to their targets one at a time with delta = the needed value. The fixed total forces the last entry to match.

## Trap

Requiring the same multiset of values. Example 1 turns [1, 2, 3] into [0, 2, 4], so that test gives false instead of true. Fix: only the total matters.

Checked: the examples give true, true and false, and the rule matched a bounded search over operations on 150 random small arrays.

Time: O(n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
