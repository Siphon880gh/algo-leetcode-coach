## Try each next piece

1. `bt(i, seen)`: if `i == n`, update `best = max(best, |seen|)`.
2. For `j` in `i + 1 .. n`: if `s[i:j]` is not in `seen`, add it, recurse at `j`, remove it.
3. Prune: if `|seen| + (n − i) ≤ best`, return.

`"ababccc"` → 5. `"aba"` → 2. `"aa"` → 1.

Greedy shortest-new-piece fails in general; search all splits. Do not forget to remove the piece after recursion.

Time: O(2^n · n) worst case  
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
