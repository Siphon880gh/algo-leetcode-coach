## Digit DP

1. P = path positions (row · 4 + column).
2. go(i, tight, last): at a path position, digits d ≥ last; elsewhere, any digit.
3. F(N) = go over the 16-digit padded N; return F(r) − F(l − 1).

Examples → 2, 1, 0. Checked against testing every x on 200 random ranges.

Requiring a strictly increasing path: example 1 → 0 instead of 2.

Time: O(16 · 2 · 10 · 10)  
Space: O(16 · 2 · 10)

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
