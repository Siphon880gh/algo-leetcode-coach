## One type at a time

1. `dp[0] = 1`, other entries 0.
2. For each `[count, marks]`: `new[t] = Σ dp[t − j · marks]` over `j = 0 … count` with `j · marks ≤ t`; `dp = new`.
3. Return `dp[target] mod (10^9 + 7)`.

Examples → 7, 4, 1. Checked against trying every combination of counts on 300 random small cases.

Building a fresh array per type stops a type from being used more than count times. The work is target · Σ count ≤ 1000 · 2500.

Time: O(target · Σ count)  
Space: O(target)

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
