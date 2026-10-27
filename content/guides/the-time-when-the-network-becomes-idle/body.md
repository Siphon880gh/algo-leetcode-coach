## Per-server formula

1. BFS from 0 for `dist`.
2. For each data server `i`: `t = 2 · dist[i]`, `p = patience[i]`; `last = (t − 1) // p · p`; candidate `last + t + 1`.
3. Return the maximum.

Examples → 8, 3. Checked against simulating each server's resends on random trees.

Sends happen at 0, p, 2p, … strictly before the first reply arrives at second `t`; the last one returns at `last + t`, and the network is idle one second later. All edges have the same length, so BFS gives shortest times.

Time: O(n + E)  
Space: O(n + E)

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
