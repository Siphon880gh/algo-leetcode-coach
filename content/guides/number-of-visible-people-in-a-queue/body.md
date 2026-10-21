## Pop what you can see

1. For `i = n − 1 … 0`: `c = 0`; while the stack top `< h[i]`: pop, `c += 1`.
2. If the stack is non-empty, `c += 1` (the first taller person).
3. `ans[i] = c`; push `h[i]`.

`[10,6,8,5,11,9]` → `[3,1,2,1,1,0]`. `[5,1,2,3,10]` → `[4,1,1,1,0]`. Checked against the definition on random arrays.

Popped people are hidden from everyone further left by `h[i]`, so removing them is safe. Heights are distinct, so no tie rule is needed.

Time: O(n)  
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
