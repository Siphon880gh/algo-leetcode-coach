## Test the merge before doing it

1. `a = find(u)`, `b = find(v)`.
2. If `a == b`: success.
3. Else fail if some restriction `(x, y)` has `{find(x), find(y)} = {a, b}`; otherwise union and succeed.

Examples → `[true,false]`, `[true,false]`, `[true,false,true,false]`.

Merging two groups makes everyone in them indirect friends, so any restriction across the two groups blocks it. With n and both lists at most 1000, scanning every restriction per request is fast enough.

Time: O(q · r · α(n))  
Space: O(n)

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
