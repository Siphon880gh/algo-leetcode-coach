A string `s` mixes plain letters with option groups such as `{a,b,c}` (groups are not nested). Each group means "pick one". Return every word the string can form, sorted lexicographically. `"{a,b}c{d,e}f"` → `["acdf","acef","bcdf","bcef"]`. `"abcd"` → `["abcd"]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Choices per position

1. Parse: walk `s`; on `{`, read up to `}`, split on commas, and sort the options; otherwise the letter is a one-item list.
2. `dfs(i, path)`: if `i == len(groups)`, record `path`; else for each option in `groups[i]`, `dfs(i + 1, path + option)`.

Every group is sorted and positions are filled left to right, so the words come out in lexicographic order.

Sorting the final list also works; sorting the groups just makes it unnecessary. Do not handle nesting; this version has none (Brace Expansion II does).

Time: O(total output length)  
Space: O(len(s)) beyond the output

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
