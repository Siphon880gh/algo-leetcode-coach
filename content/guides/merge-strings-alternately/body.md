## Interleave

1. For `i` in `range(max(len(a), len(b)))`: append `a[i]` if it exists, then `b[i]` if it exists.

`"abc", "pqr"` → `"apbqcr"`. `"ab", "pqrs"` → `"apbqrs"`. `"abcd", "pq"` → `"apbqcd"`.

Start with `word1`. Build a list and join once rather than concatenating strings in a loop.

Time: O(m + n)  
Space: O(m + n)

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
