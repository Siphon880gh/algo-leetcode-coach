## Digit DP

1. go(i, last, tight, started): before the first non-zero digit nothing is checked; after it, the next digit d needs |d − last| ≤ k.
2. F(N) = go(0, none, true, false); return F(r) − F(l − 1).

Examples → 3, 2. Checked against testing every number on 300 random ranges. Edge check: k = 9 over [10, 10^15] → 10^15 − 9.

Counting leading zeros as digits: constructed check (run in code) l = 10, r = 99, k = 1 with 3-digit padding → 3 instead of 26.

Time: O(16 · 10 · 10)  
Space: O(16 · 10)

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
