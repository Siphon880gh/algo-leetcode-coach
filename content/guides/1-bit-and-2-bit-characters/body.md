## The decoding is forced

`i = 0`. While `i < n − 1`: `i += 2` if `bits[i] == 1`, else `i += 1`. Return `i == n − 1`.

Each step is forced: a 1 can only begin `10` or `11`, and a 0 at a character start can only be the one-bit character.

A shortcut: count the consecutive 1s just before the final 0. If the count is even, they pair up among themselves and the last 0 stands alone, so the answer is true; if odd, the last 1 swallows the final 0.

Do not decode from the end; the meaning of a bit depends on what precedes it.

Time: O(n)  
Space: O(1)

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
