## Example first

nums = [3, 1, 4, 2, 5].

1. Pair (0, 2) = (3, 4). Between them is 1, which is not strictly between 3 and 4. It counts.
2. Pair (1, 4) = (1, 5). The 4 at index 2 sits between, and 1 < 4 < 5. It fails.
3. The pairs that count are (0, 2), (1, 2), (1, 3), (2, 4) and (3, 4). Answer 5.

Picture each index as a point (i, nums[i]). A pair counts when the open box between its two points is empty.

## Cross pairs

Split at mid and count pairs with i in the left half and j in the right half.

1. For each left i: U[i] = the smallest value above nums[i] among positions (i, mid]. Then nums[j] must be ≤ U[i].
2. For each right j: D[j] = the largest value below nums[j] among positions [mid + 1, j). Then nums[i] must be ≥ D[j].
3. Count pairs with D[j] ≤ nums[i] < nums[j] ≤ U[i]. Sort right indices by nums[j], largest first. Add left indices to a Fenwick tree over nums[i] once U[i] ≥ nums[j], then query [D[j], nums[j] − 1].
4. Recurse on both halves.

Get U and D with an ordered set while scanning outward from mid.

## Trap

Using part I's rule, where any smaller value in between blocks the pair. Example 1 then gives 4 instead of 5. Fix: only values strictly between the two ends block.

Checked: the examples give 5 and 3, and the method matched checking every pair on 500 random arrays with many repeated values.

Time: O(n log² n)  
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
