## Rank map

1. `rank = {v: i + 1 for i, v in enumerate(sorted(set(arr)))}`.
2. Return `[rank[x] for x in arr]`.

`[40,10,20,30]` → `[4,1,2,3]`. `[100,100,100]` → `[1,1,1]`. `[37,12,28,9,100,56,80,5,12]` → `[5,3,4,2,8,6,7,1,3]`.

Do not rank with duplicates still in the sorted list; ranks would skip numbers. Do not forget the empty array; it returns empty.

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
