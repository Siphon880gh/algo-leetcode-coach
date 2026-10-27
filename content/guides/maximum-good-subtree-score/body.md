## Merge by submasks

1. f(u) starts with best[0] = 0.
2. For each child c: new[mask] = max over submasks s of best[mask ^ s] + f(c)[s].
3. If vals[u] has distinct digits with mask m: best[mask | m] = max(…, best[mask] + vals[u]) for mask disjoint from m.
4. maxScore[u] = max(best); answer Σ maxScore mod 10^9 + 7.

Examples → 8, 15, 42, 18. Checked against trying every subset of every subtree on 150 random trees.

Taking the largest usable values first: vals = [36, 6, 31], par = [−1, 0, 1] → 104 instead of 105.

Time: O(n · 3^10)  
Space: O(n · 2^10)

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
