## Earliest arrival

1. d[0] = 0; heap of (time, node).
2. Pop (t, u). For each edge u → v: dep = max(t, start); if dep ≤ end, relax d[v] with dep + 1.
3. Answer d[n − 1], or −1.

Examples → 3, 5, −1. Checked against a step-by-step time simulation on 500 random graphs.

Ignoring the windows: example 1 → 2 instead of 3.

Time: O((n + E) log n)  
Space: O(n + E)

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
