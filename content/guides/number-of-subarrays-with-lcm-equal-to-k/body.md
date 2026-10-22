## Running LCM per start

1. For each `i`: `l = 1`.
2. For `j = i …`: `l = lcm(l, nums[j])`; if `k mod l ≠ 0`, stop; if `l = k`, `count++`.
3. Return `count`.

Examples → 4, 0. Checked against computing every subarray’s LCM on 300 random cases.

The LCM only gains factors as the subarray grows, so once it stops dividing k it never comes back. Stopping there also keeps l ≤ k ≤ 1000, so it never overflows.

Time: O(n² log k)  
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
