## Two conditions

`s.count('A') < 2 and 'LLL' not in s`.

One pass: count `A`s and keep a streak of `L`s (reset on any other character); fail as soon as `A` reaches 2 or the streak reaches 3.

Student Attendance Record II (552) counts how many length-`n` records would pass.

Do not reset the absence count — the 2-absence rule is over the whole record, while the late rule is about consecutive days. Do not allow exactly 2 absences.

Time: O(n)  
Space: O(1)

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
