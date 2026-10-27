## Choose which steps go forward

1. `d = |endPos − startPos|`.
2. If `d > k` or `(k − d)` is odd, return 0.
3. Return `C(k, (k + d) / 2) mod 10^9 + 7`, using Pascal’s triangle or factorials with modular inverses.

Examples → 3, 0. Checked against a step-by-step DP over positions on 200 random cases.

Forward steps f and backward steps b satisfy f + b = k and f − b = d, so f is fixed and only its positions vary. The line is infinite, so no walls cut paths. A DP over k ≤ 1000 steps and positions also passes.

Time: O(k) or O(k²)  
Space: O(k)

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
