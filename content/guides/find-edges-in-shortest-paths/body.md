## Two distance arrays

1. d0 = Dijkstra from 0; dn = Dijkstra from n − 1; D = d0[n − 1].
2. If D is infinite, return all false.
3. answer[i] = d0[a] + w + dn[b] = D or d0[b] + w + dn[a] = D.

Examples → [true, true, true, false, true, true, true, false], [true, false, false, true]. Checked against listing every simple path on 300 random small graphs.

Check both directions: only a → b gives example 2 → all false.

Time: O((n + m) log n)  
Space: O(n + m)

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
