## Convex hull trick

1. f_0[0] = 0, others ∞.
2. For each layer j = 1 … k: walk i = 0 … n. Query the deque at x = P_i for g[i] = min(line(x)) + x². Then add the line (−2P_i, f[i] + P_i²) if f[i] is finite, dropping lines that can no longer win.
3. Answer (f_k[n] + P_n) / 2.

Examples → 25, 55, 3. Checked against trying every cut set on 3,000 random arrays.

Closing a part once its sum reaches total / k: constructed check (run in code) nums = [4, 6, 1, 3], k = 3 → 62 instead of 41.

Time: O(k · n)  
Space: O(n)

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
