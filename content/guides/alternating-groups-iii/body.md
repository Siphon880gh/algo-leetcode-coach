## Run lengths

1. Break b: colors[b] = colors[b + 1 mod n]. Consecutive breaks b < b′ bound a run of length b′ − b (wrapping); one break gives a run of n.
2. Fenwick trees over L hold the count and the sum of run lengths. Query s: sum − (s − 1) · count over L ≥ s. No breaks: n.
3. An update removes or adds breaks at index − 1 and index, splitting or merging runs.

Examples → [2], [2, 0]. Checked the run formula against counting every start on 500 random circles.

Ignoring the wrap: example 1 → [1] instead of [2].

Time: O((n + q) log n)  
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
