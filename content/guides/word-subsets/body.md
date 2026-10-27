## One combined requirement

1. `need[c] = max over b in words2 of count_b(c)` for each letter `c`.
2. For each `a` in `words1`, count its letters; keep `a` if `count_a(c) ≥ need[c]` for all 26 letters.

Return the kept words.

Taking the maximum (not the sum) is right: each `b` must fit in `a` separately, so `a` only needs to satisfy the hardest one per letter.

Do not check every pair `(a, b)`; that is O(|words1| · |words2| · len). Do not sum the counts across words2; `"e"` and `"oo"` together do not need two e's.

Time: O(total letters + 26 · |words1|)  
Space: O(1) besides the output

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
