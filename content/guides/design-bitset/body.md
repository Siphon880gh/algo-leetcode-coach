## O(1) flip

1. `a` = bits (all 0), `b` = complement (all 1), `cnt = 0`.
2. `fix(i)`: if `a[i] = 0`, set `a[i] = 1`, `b[i] = 0`, `cnt += 1`. `unfix` is the reverse.
3. `flip()`: swap `a` and `b`; `cnt = size − cnt`.
4. `all`: `cnt = size`; `one`: `cnt > 0`; `count`: `cnt`; `toString`: join `a`.

Example 1 → `[null,null,null,null,false,null,null,true,null,2,"01010"]`.

Up to 10^5 calls on 10^5 bits rule out flipping every bit. A lazy flip flag works too, interpreting each stored bit through the flag.

Time: O(1) per call, O(size) for toString  
Space: O(size)

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
