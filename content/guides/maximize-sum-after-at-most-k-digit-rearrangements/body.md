## Example first

nums = [102, 90, 14], k = 2.

| Number | Best rearrangement | Gain |
|--------|--------------------|------|
| 102 | 210 | 108 |
| 90 | 90 | 0 |
| 14 | 41 | 27 |

Spend both operations on 102 and 14: 210 + 90 + 41 = 341.

## Steps

1. best(x) = x's digits sorted from largest to smallest. Its gain best(x) − x is never negative.
2. Sort the gains from largest to smallest.
3. Answer = sum(nums) + the top k gains.

Gains of different numbers do not interact, so the greedy choice is safe.

## Trap

Rearranging the k largest numbers. 90 gains nothing, so picking 102 and 90 gives 314 instead of 341. Fix: rank by gain.

Checked: the examples give 366 and 341, and the greedy matched trying every choice of up to k numbers on 300 random cases.

Time: O(n log n)  
Space: O(n)

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
