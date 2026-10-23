## Tokenize

1. s = join(chunks).
2. A hyphen at i stays only if s[i − 1] and s[i + 1] exist and are letters; otherwise it becomes a space.
3. cnt = counts of the space-separated words; answer cnt[q] for each query.

Examples → [2, 1, 0], [2, 1, 1], [1, 1, 1, 0]. Checked against listing every maximal word on 3,000 random strings.

Splitting each chunk on its own: example 1 → [2, 0, 1] instead of [2, 1, 0].

Time: O(n + total query length)  
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
