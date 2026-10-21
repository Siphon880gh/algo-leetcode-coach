You are given lists of regions where the first region in each list directly contains all the others in that list. Given two regions, return the smallest region that contains both. For instance, with `["Earth","North America","South America"]`, `["North America","United States","Canada"]`, and `["United States","New York","Boston"]`, the regions `"Boston"` and `"Canada"` give `"North America"`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Parent pointers

1. For each list, `parent[child] = list[0]` for every later entry.
2. `anc` = the set of `region1` and all its ancestors.
3. Walk up from `region2` until a region in `anc`; return it.

A region contains itself, so if one region contains the other, the answer is the outer one.

Do not build children lists and run DFS from the root; parent pointers are enough. Do not exclude the regions themselves from the ancestor set.

Time: O(total regions)  
Space: O(total regions)

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
