## Enumerate the puzzle side

1. `cnt[mask(word)] += 1` for each word (duplicate letters collapse).
2. For a puzzle: `first = bit(p[0])`, `rest` = mask of `p[1:]`.
3. `sub = rest`; loop: `total += cnt[sub | first]`; stop after `sub == 0`; else `sub = (sub − 1) & rest`.

Each puzzle has 7 distinct letters, so this is at most 2⁶ = 64 lookups.

`words = ["apple","pleas","please"]`, `puzzles = ["aelwxyz","aelpxyz","aelpsxy","saelpxy","xaelpsy"]` → `[0,1,3,2,0]`.

Do not test every word against every puzzle; that is 10⁹ checks. Do not drop the first-letter requirement; every valid word must contain it.

Time: O(total word length + 64 · puzzles)  
Space: O(distinct masks)

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
