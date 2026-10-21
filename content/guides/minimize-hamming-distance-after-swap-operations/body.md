## Free permutation per component

1. DSU over indices; union each allowed pair.
2. `cnt[root][source[i]] += 1`.
3. For each `i`: if `cnt[root(i)][target[i]] > 0`, decrement; else `dist += 1`.

`[1,2,3,4]`/`[2,1,4,5]` with swaps `[[0,1],[2,3]]` → 1. No swaps → 2. Example 3 → 0.

Swaps can be reused any number of times, which is why a component behaves like a multiset. Do not simulate swaps.

Time: O((n + E) α(n))  
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
