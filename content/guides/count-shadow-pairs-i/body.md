## Example first

nums = [3, 1, 4, 1, 5].

1. i = 0 (value 3): index 1 holds 1 < 3 and blocks every j after it. 0 pairs.
2. i = 1 (value 1): nothing to the right is smaller, so j can be 2, 3 or 4. Values 4 and 5 are bigger; the other 1 is equal. 2 pairs.
3. i = 3 (value 1): j = 4 with 5. 1 pair.

Answer 3.

## Steps

1. Monotonic stack: R[i] = the next index with a strictly smaller value (n if none).
2. Every value in (i, R[i]) is at least nums[i]. The pairs are the strictly larger ones: (R[i] − i − 1) minus the copies of nums[i] in that range.
3. Count the copies with the sorted index list of that value and two binary searches.
4. Add up over i.

## Trap

Counting equal values as pairs. In Example 2 the 6s at indices 2 and 3 sit inside each other's range, and counting them gives 7 instead of 4. Fix: subtract the equal copies.

Checked: the examples give 3, 4 and 6, and the count matched checking every pair on 300 random arrays.

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
