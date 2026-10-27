## 26 states

1. `dp = [0] · 26`.
2. For each `ch` with index `c`: `dp[c] = 1 + max(dp[c − k … c + k])`, clipped to `a … z`.
3. Return `max(dp)`.

Examples → 4, 4. Checked against every subsequence on 300 random strings.

Only the last letter of a subsequence matters for extending it, so 26 states cover every option. The alphabet is not cyclic, so the window is clipped rather than wrapped.

Time: O(26 · n)  
Space: O(26)

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
