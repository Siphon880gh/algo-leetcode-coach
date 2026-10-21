## dp per lane

1. Start `dp = [1, 0, 1]` (lane 2 free, others need one jump).
2. For each point `i ≥ 1`: if `obstacles[i] = L`, set `dp[L] = ∞`.
3. Then `dp[l] = min(dp[l], min(dp) + 1)` for every lane without an obstacle at `i`.
4. Answer `min(dp)` at point n.

`[0,1,2,3,0]` → 2. `[0,1,1,3,3,0]` → 0. `[0,2,1,0,3,0]` → 2.

Block the obstacle lane before the side-jump update so it cannot be the target of a jump at that point.

Time: O(n)  
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
