## Example first

nums = [1, 1, 2, 2, 2, 3]. The runs are [1, 1], [2, 2, 2] and [3].

1. Keep one element of each run.
2. Delete 1 + 2 = 3 elements.
3. [1, 2, 3] is sharp. Answer 3.

## Steps

1. a XOR b = 0 exactly when a = b.
2. A run of length L must lose L − 1 elements, and it has exactly L − 1 equal neighbour pairs.
3. Count the indices i with nums[i] = nums[i + 1].

Different runs already meet at unequal values, and deleting inside a run never makes two runs touch with equal values.

## Trap

Deleting every duplicate value. In [4, 4, 9, 4] the last 4 sits next to 9, so only one 4 must go. Counting all duplicates gives 2 instead of 1. Fix: only adjacent equals matter.

Checked: the examples give 3 and 1, and the count matched trying every deletion set on 300 random arrays.

Time: O(n)  
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
