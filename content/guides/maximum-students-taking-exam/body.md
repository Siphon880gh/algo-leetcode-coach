## Masks per row

1. `ok[i]` = bitmask of `.` seats in row `i`.
2. A row mask is valid if `mask & ~ok[i] == 0` and `mask & (mask >> 1) == 0`.
3. Compatible with previous `p` if `mask & (p >> 1) == 0` and `mask & (p << 1) == 0`.
4. `dp[mask] = popcount(mask) + max dp_prev[p]` over compatible `p`.

The three examples → 4, 3, 10.

Do not forbid the seat directly in front; only diagonal neighbours are visible. Do not seat students on broken `#` seats.

Time: O(m · 4ⁿ)  
Space: O(2ⁿ)

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
