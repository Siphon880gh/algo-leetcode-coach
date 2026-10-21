## Even indices, then odd

1. Count each barcode.
2. Order the codes by count, highest first.
3. `i = 0`. For each code, for each copy: put it at `i`, then `i += 2`; when `i ≥ n`, set `i = 1`.

The most frequent code fits in the even slots because a solution exists, and every later code fills a contiguous run of slots two apart, so equal codes never touch.

Do not use a heap that pops one code at a time unless you also hold back the previous code; the slot method avoids that bookkeeping. Do not skip sorting by count; a common code placed late may land next to itself.

Time: O(n log n)  
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
