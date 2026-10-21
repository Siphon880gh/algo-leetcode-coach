## Rotation trick

If `s = p·p·…·p` (k ≥ 2 copies), rotating `s` left by `|p|` gives `s` again. Every rotation of `s` appears as a substring of `s + s`. So `s` shows up in `s + s` at index `|p|`, strictly between 0 and `|s|`. The converse also holds: if `s` occurs at some `0 < d < |s|`, then `s` has period `d`, and the smallest such `d` divides `|s|`. So the test is `(s + s).find(s, 1) < len(s)`. Use KMP to make the find linear.

Direct check: for each `d` from 1 to `|s| / 2` with `|s| % d == 0`, test whether `s[i] == s[i − d]` for all `i >= d`. That is O(n · number of divisors), fine here.

KMP also gives it directly: with failure function `π`, let `p = n − π[n − 1]`. The answer is `π[n − 1] > 0` and `n % p == 0`.

Repeated String Match (686) asks how many copies of `a` contain `b`. Find the Index of the First Occurrence (28) is the plain search.

Do not count `s` itself as one repetition — at least two copies are needed. Do not test periods that do not divide `|s|`.

Time: O(n) with KMP  
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
