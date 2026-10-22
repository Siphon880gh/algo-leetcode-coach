## Matrix exponent

1. A[c][(c + j) mod 26] += 1 for j = 1 … nums[c].
2. P = A^t by repeated squaring, mod 10^9 + 7.
3. Answer Σ_c cnt[c] · (row sum of P[c]).

Examples → 7, 8. Checked against building the string on 50 small cases.

Simulating round by round: up to 10^9 rounds of 26 · 25 updates.

Time: O(26³ log t + n)  
Space: O(26²)

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
