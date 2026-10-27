## One clock for all walks

1. `t[u] = 0` for all; `clk = 1`, `best = −1`.
2. For each `s` with `t[s] = 0`: `start = clk`; walk `u = s` while `u ≠ −1` and `t[u] = 0`, setting `t[u] = clk++`.
3. If the walk stopped at `u ≠ −1` with `t[u] ≥ start`, `best = max(best, clk − t[u])`.

Examples → 3, −1. Checked against walking from every node until it returns on 500 random graphs.

Each node is stamped once, so the total work is O(n). A node stamped by an earlier walk leads into territory already explored, so any cycle there was already counted. Kahn’s algorithm, peeling in-degree 0 nodes and measuring what is left, works too.

Time: O(n)  
Space: O(n)

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
