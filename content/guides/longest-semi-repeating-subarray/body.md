Given an integer array and an integer k, call a subarray semi-repeating if at most k distinct values appear more than once in it. Return the length of the longest semi-repeating subarray. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Window

1. For each r: cnt[x] += 1; if it became 2, rep += 1.
2. While rep > k: drop nums[l]; if its count fell to 1, rep −= 1; l += 1.
3. best = max(best, r − l + 1).

Constructed checks (run in code): [1, 2, 1, 3, 2, 3], k = 1 → 4; [4, 4, 5, 5], k = 0 → 2; [1, 1, 1], k = 1 → 3. Checked against every subarray on 2,000 random cases.

Counting extra copies instead of distinct repeated values: [1, 1, 1], k = 1 → 2 instead of 3.

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
