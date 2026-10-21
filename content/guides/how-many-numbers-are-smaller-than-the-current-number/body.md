## Counting sort idea

1. `cnt[x + 1] += 1` for each `x`.
2. Prefix sums: `cnt[i] += cnt[i − 1]`.
3. Answer for `x` is `cnt[x]`.

`[8,1,2,2,3]` → `[4,0,1,1,3]`. `[6,5,4,8]` → `[2,1,0,3]`. `[7,7,7,7]` → `[0,0,0,0]`.

Do not count equal values as smaller. Sorting with binary search also works in O(n log n), but the value range allows O(n + 101).

Time: O(n + V)  
Space: O(V)

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
