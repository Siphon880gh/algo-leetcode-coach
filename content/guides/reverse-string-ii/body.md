## Step by 2k

Convert to a list. For `i` in `range(0, n, 2k)`: reverse `cs[i : min(i + k, n)]` (two pointers swapping, or slice assignment `cs[i:i+k] = reversed(cs[i:i+k])`). Join and return.

The `min(i + k, n)` covers both special cases at the end: a short tail is fully reversed, and a medium tail reverses only its first `k`.

Reverse String (344) reverses the whole array in place.

Do not step by `k` — the next `k` characters after a reversed block stay as they are. Do not reverse the full `2k` block.

Time: O(n)  
Space: O(n) for the list (strings are immutable in many languages)

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
