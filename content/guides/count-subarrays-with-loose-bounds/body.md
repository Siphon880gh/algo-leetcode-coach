## Example first

nums = [1, 4, 7, 3], minK = 1, maxK = 5.

1. 7 is out of range, so no valid subarray crosses it.
2. The stretch [1, 4] holds [1], [4] and [1, 4]: 3 subarrays.
3. The stretch [3] holds [3]: 1 subarray.

Answer 4.

## Steps

1. l = start of the current in-range stretch.
2. For each r: if nums[r] is out of range, set l = r + 1.
3. Otherwise add r − l + 1, the number of valid subarrays that end at r.

The count reaches about 5 × 10^9, so use 64 bits.

## Trap

Requiring the subarray's minimum to be minK and its maximum to be maxK. That is a different problem, and it gives 0 instead of 4 here. Fix: every value only has to lie inside [minK, maxK].

Checked: the examples give 4 and 3, and the count matched checking every subarray on 300 random arrays.

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
