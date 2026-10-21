## Shortest matching ends first

`count = 0`, `i = 0`, `j = n` (the remaining text is `text[i:j]`). While `i < j`:

- Find the smallest `L` with `2L ≤ j − i` and `text[i:i + L] == text[j − L:j]`.
- If found: `count += 2`, `i += L`, `j −= L`.
- Else: `count += 1`; stop (the middle is one chunk).

Return `count`.

If a longer match exists, the shortest one is a prefix and suffix of it, so peeling the shortest first never loses chunks.

Compare substrings with a rolling hash to make each step faster. Do not grow chunks from the middle outward; the ends are what must match.

Time: O(n²) with direct comparison, O(n) expected with hashing  
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
