## At most two distinct values

`count = {}`, `left = 0`, `best = 0`. For each `right`:

1. `count[fruits[right]] += 1`.
2. While `len(count) > 2`: decrement `count[fruits[left]]`, delete it at 0, `left += 1`.
3. `best = max(best, right − left + 1)`.

Return `best`.

Each index enters and leaves the window once.

Do not restart the window at the third type's position; the window should keep the most recent type it already holds. Do not track only the last two values without counts; you need to know when a type has left the window.

Time: O(n)  
Space: O(1) (at most three keys)

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
