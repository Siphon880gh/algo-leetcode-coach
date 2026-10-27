## Example first

nums = [5, 8, 8, 2, 2, 2], starting at index 0.

| Subarray | Order and counts | Staircase |
|----------|------------------|-----------|
| [5] | 5: 1 | yes |
| [5, 8] | 5: 1, 8: 1 of 2 | not yet |
| [5, 8, 8] | 5: 1, 8: 2 | yes |
| [5, 8, 8, 2, 2, 2] | 5: 1, 8: 2, 2: 3 | yes |

With the other left ends, the answer is 9.

## Steps

1. For each left end i, walk j to the right.
2. A value seen for the first time gets order = number of distinct values so far.
3. Increase its count. If the count passes its order, stop: every longer subarray from i keeps that extra copy.
4. When the count reaches its order exactly, add 1 to ok. When ok equals the number of distinct values, count the subarray.

## Trap

Ignoring the order of first appearance. [8, 8, 2] has counts 2 and 1, which look like {1, 2}, but 8 comes first and must appear once. Ignoring order gives 10 instead of 9 for Example 1. Fix: tie each value to its order.

Checked: the examples give 9, 5 and 8, and the scan matched checking every subarray on 300 random arrays.

Time: O(n²)  
Space: O(n)

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
