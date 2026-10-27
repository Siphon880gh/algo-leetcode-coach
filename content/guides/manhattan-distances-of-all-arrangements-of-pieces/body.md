## Pairs times arrangements

1. pairs = Σ_{d=1}^{m−1} d (m − d) · n² + Σ_{d=1}^{n−1} d (n − d) · m².
2. Answer pairs · C(mn − 2, k − 2) mod 10^9 + 7, with factorials and inverse factorials.

Examples → 8, 20. Checked against every arrangement for m, n ≤ 3.

Multiplying by C(mn, k) instead: example 1 → 48 instead of 8.

Time: O(mn)  
Space: O(mn)

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
