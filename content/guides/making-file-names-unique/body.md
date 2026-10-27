## Remember where you stopped

1. If `name` is unused: use it; `next[name] = 1`.
2. Else: `k = next[name]`; while `name(k)` is used, `k += 1`. Use `name(k)`; set `next[name] = k + 1` and `next[name(k)] = 1`.

`["gta","gta(1)","gta","avalon"]` → `["gta","gta(1)","gta(2)","avalon"]`. `["onepiece","onepiece(1)","onepiece(2)","onepiece(3)","onepiece"]` → last becomes `"onepiece(4)"`.

Do not restart k at 1 every time; repeated names would make it O(n²). Do register the generated name, since it can collide later.

Time: O(n · L) amortised  
Space: O(n · L)

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
