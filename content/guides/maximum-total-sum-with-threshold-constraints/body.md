You get two arrays of equal length, nums and threshold. Starting at step 1, you repeatedly pick an unused index whose threshold is at most the current step, add its value to a running total, and move to the next step. The process ends at the first step with no such index. Return the largest total you can reach. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Find T

1. cnt[t] = number of indices with threshold t (ignore t > n).
2. Walk s = 1 … n with a running total; stop at the first s with total < s. T = s − 1.
3. Return the sum of nums[i] with threshold[i] ≤ T.

Assumed here: values are positive, so the process never stops early by choice.

Constructed checks (made-up values, run in code): nums = [3, 8, 1, 5], threshold = [1, 3, 2, 4] → 17; nums = [7, 2, 9], threshold = [2, 1, 1] → 18; nums = [4, 6], threshold = [2, 2] → 0. Checked against trying every pick order on 1,500 random cases.

Summing every index with threshold ≤ n: nums = [4, 6], threshold = [2, 2] → 10 instead of 0.

Time: O(n)  
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
