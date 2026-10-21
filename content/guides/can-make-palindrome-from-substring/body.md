## Parity per prefix

1. `pre[0] = 0`; `pre[i + 1] = pre[i] ^ (1 << (s[i] − 'a'))`.
2. Query `(l, r, k)`: `odd = popcount(pre[r + 1] ^ pre[l])`; answer `odd // 2 ≤ k`.

Rearranging is allowed, so only letter parity matters; each replacement fixes two odd letters, and one odd letter may stay in the middle.

`"abcda"`, queries `[[3,3,0],[1,2,0],[0,3,1],[0,3,2],[0,4,1]]` → `[true,false,false,true,true]`.

Do not count letters per query; with 10⁵ queries that is too slow. Do not compare `odd ≤ k`; one replacement fixes two letters.

Time: O(n + q)  
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
