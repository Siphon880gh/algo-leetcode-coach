## Search the threshold

1. source = target → 0.
2. Candidates = sorted {0} ∪ weights. If even the largest fails, return −1.
3. ok(T): 0-1 BFS, heavy (w > T) costs 1, light 0; ok when dist[target] ≤ k.
4. Return the smallest candidate with ok.

Examples → 4, −1, 0. Checked on 2,000 random graphs against every simple path, taking its (k + 1)-th largest weight.

Using the bottleneck path and ignoring k: example 1 → 5 instead of 4.

Time: O((n + m) log m)  
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
