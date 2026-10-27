## Try c = 1 … 10

1. If `num = 0`, return 0.
2. For `c = 1 … 10`: if `c · k ≤ num` and `(num − c · k) mod 10 = 0`, return `c`.
3. Return −1.

Examples → 2, −1, 0. Checked against a coin-change DP for every num < 200 and every k.

With c terms the sum ends in `c · k mod 10`, and any extra amount that is a multiple of 10 can go into one term, so only the units digit and `c · k ≤ num` matter. `c · k mod 10` cycles within 10 steps, so c > 10 never helps. For k = 0 the terms are 10, 20, …, so one term works whenever num is a positive multiple of 10.

Time: O(1)  
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
