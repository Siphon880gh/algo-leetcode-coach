## Row by row

1. `tops[(a, b)]` = the list of `c` from allowed triples `abc`.
2. `can(row)`: if `len(row) == 1`, return true. Otherwise build every possible next row: position `i` must be one of `tops[(row[i], row[i + 1])]`. Use DFS over positions; when a full next row is built, return true if `can(next)` does.
3. Memoize `can` on the row string, since many partial choices lead to the same next row.

If any adjacent pair has no allowed top, that row fails immediately.

The bottom has at most 6 blocks and the alphabet is `A`–`F`, so memoized backtracking is fast. A bitmask over letters per pair speeds it up more.

Do not build all possible next rows up front with a product over positions without pruning; the count can blow up. Do not forget memoization; the same rows recur through different paths.

Time: exponential in the bottom length, small in practice  
Space: O(number of distinct rows memoized)

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
