## 30 states, 6 choices

1. If `n = 1`, return 6.
2. `dp[a][b] = 1` for `a ≠ b` with `gcd(a, b) = 1`.
3. Repeat `n − 2` times: `new[b][c] += dp[a][b]` for each `c` with `gcd(b, c) = 1`, `c ≠ a`, `c ≠ b`.
4. Return `Σ dp` modulo 10^9 + 7.

Examples → 184, 22. Checked against listing every sequence for n ≤ 5.

Equal values must be more than 2 rolls apart, so only the last two rolls matter for the next one. gcd(b, b) = b, so a repeat right after itself is excluded anyway except for 1, which is why c ≠ b is still needed.

Time: O(n · 6³)  
Space: O(36)

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
